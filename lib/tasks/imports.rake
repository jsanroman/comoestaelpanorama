
namespace :imports do

  task :downloads_all => :environment do

    Parsers::Unemployed.download_all

  end
end
