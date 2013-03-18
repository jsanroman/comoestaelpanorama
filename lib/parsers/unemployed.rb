require 'net/http'

module Parsers


  # Download and parse unemployment data
  class Unemployed

    @@domain = 'http://www.sepe.es'
    @@months = [:enero, :febrero, :marzo, :abril, :mayo, :junio, :julio, :agosto, :septiembre, :octubre, :noviembre, :diciembre]
    @@years = [2010, 2011, 2012, 2013]


    def init
      # self.download
    end


    # Download all xls files from http://www.sepe.es/contenido/estadisticas/datos_estadisticos/municipios_capitales/index.html
    def self.download_all

      @@years.each do |year|

        @@months.each do |month|

          puts month.to_s+'__'+year.to_s;

          begin

            doc = Nokogiri::HTML(RestClient.get(@@domain+'/contenido/estadisticas/datos_estadisticos/municipios_capitales/'+year.to_s+'/'+month.to_s+'.html'))

            doc.css('#informacion table tbody tr').each do |tr_xls|

              city = tr_xls.css('td')[0].content

              td_xls = tr_xls.css('td')[1]
              link_xls = td_xls.css('a')[0].attributes['href']

              puts link_xls

              Net::HTTP.start('www.sepe.es') do |http|
                resp = http.get(@@domain+link_xls)
                File.open('app/assets/opendata2/'+city+'_'+year.to_s+'_'+month.to_s+'.xls', "wb") do |file|
                  file.write(resp.body)
                end
              end
            end

          rescue Exception => error
            raise error if error.message['404']
          end
        end
      end
    end

  end
end
