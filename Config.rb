#Please DO NOT delete this file. It is in use for SASS/Compass development
preferred_syntax = :sass
http_path = '/'
css_dir = 'app/css'
sass_dir = 'app/sass'
images_dir = 'app/images'
javascripts_dir = 'app/js'
fonts_dir = 'app/fonts/'
relative_assets = true
line_comments = false
output_style = :nested

require 'autoprefixer-rails'

on_stylesheet_saved do |file|
  css = File.read(file)
  File.open(file, 'w') do |io|
    io << AutoprefixerRails.process(css)
  end
end