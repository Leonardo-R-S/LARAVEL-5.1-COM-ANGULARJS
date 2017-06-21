var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

//Arquives the config  Arquivo de configuração que recebe um array
var config = {
   //Local onde ficara a aplição do angular
  assets_path:'./resources/assets',
   //Local onde vai ficar os arquivos na pasta publica
  build_path:'./public/build'
};
//Local onde fica o Boower components
config.bower_path = config.assets_path+'/../bower_components';
//Local onde fica os arquivos publicos de java script
config.build_path_js = config.build_path + '/js';
//Local onde vai ficar os arquivos java script de terceiros
config.build_vendor_path_js = config.build_path_js+'/vendor';
//Define quais arquivos de terceiros que seram usados
config.vendor_path_js= [
    config.bower_path+'/jquery/dist/jquery.min.js',
    config.bower_path+'/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path+'/angular/angular.js',
    config.bower_path+'/angular-route/angular-route.min.js',
    config.bower_path+'/angular-resource/angular-resource.js',
    config.bower_path+'/angular-animate/angular-animate.min.js',
    config.bower_path+'/angular-messages/angular-messages.min.js',
    config.bower_path+'/angular-bootstrap/ui-bootstrap-tpls.min.js',
    config.bower_path+'/angular-strap/dist/modules/navbar.min.js',

    config.bower_path+'/angular-cookie/angular-cookie.min.js',

    config.bower_path+'/query-string/query-string.js',
    config.bower_path+'/angular-oauth2/dist/angular-oauth2.min.js',
    config.bower_path+'/ng-file-upload/ng-file-upload.min.js'

];

//Local onde fica os arquivos publicos de css
config.build_path_css = config.build_path + '/css';
//Local onde vai ficar os arquivos css de terceiros
config.build_vendor_path_css = config.build_path_css+'/vendor';
//Define quais arquivos de terceiros que seram usados
config.vendor_path_css= [
    config.bower_path+'/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path+'/bootstrap/dist/css/bootstrap-theme.min.css',

];

//Local onde fica os HTML
config.build_path_html = config.build_path + '/views';
//Local onde fica os imagens
config.build_path_images = config.build_path + '/images';
//Local onde fica os fontes
config.build_path_fonts = config.build_path + '/fonts';

gulp.task('copy-html', function () {
    //Busca todos os arquivos html nas sub pastas
    gulp.src([ config.assets_path+'/js/views/**/*.html'])
    //Copia para esta pasta
        .pipe(gulp.dest(config.build_path_html))
        //Mosta ação no terminal
        .pipe(liveReload());

});

gulp.task('copy-images', function () {
    //Busca todos os arquivos images nas sub pastas
    gulp.src([ config.assets_path+'/images/**/*'])
    //Copia para esta pasta
        .pipe(gulp.dest(config.build_path_images))
        //Mosta ação no terminal
        .pipe(liveReload());

});

gulp.task('copy-fonts', function () {
    //Busca todos os arquivos fonts nas sub pastas
    gulp.src([ config.assets_path+'/fonts/**/*'])
    //Copia para esta pasta
        .pipe(gulp.dest(config.build_path_fonts))
        //Mosta ação no terminal
        .pipe(liveReload());

});

//Função para verificar os arquivos css e copialos para outra pasta
gulp.task('copy-styles', function () {
    //Busca todos os arquivos css nas sub pastas
    gulp.src([
        
        config.assets_path+'/css/**/*.css'])
        //Copia para esta pasta
        .pipe(gulp.dest(config.build_path_css))
        //Mosta ação no terminal
        .pipe(liveReload());
    //Faz o mesmo só que com arquivos de terceiros
    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_vendor_path_css))
        .pipe(liveReload());
});


//Função para verificar os arquivos java script e copialos para outra pasta
gulp.task('copy-scripts', function () {
    //Busca todos os arquivos css nas sub pastas
    gulp.src([config.assets_path+'/js/**/*.js'])
    //Copia para esta pasta
        .pipe(gulp.dest(config.build_path_js))
        //Mosta ação no terminal
        .pipe(liveReload());
    //Faz o mesmo só que com arquivos de terceiros
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_vendor_path_js))
        .pipe(liveReload());
});
//Função para limpar as pastas de Public/Build
gulp.task('clear_build_folder',function () {
    //Indica qual caminho deve ser limpo
    clean.sync(config.build_path);
});

//Função para mesclar e copilar os arquivos de js e css tanto de terceiros quanto pessoais, e tambem versionar os arquivos.
gulp.task('default',['clear_build_folder'], function () {
    gulp.start('copy-html','copy-images','copy-fonts');
    elixir(function(mix) {
        mix.styles(config.vendor_path_css.concat([config.assets_path+'/css/**/*.css']),'public/css/all.css',config.assets_path);
        mix.scripts(config.vendor_path_js.concat([config.assets_path+'/js/**/*.js']),'public/js/all.js',config.assets_path);
        mix.version(['js/all.js','css/all.css']);
    });

});

//Função que executa o metodo listen, e chama copy-styles e copy-scripts (OBS. a função clear_build_folder sera executada antes).
gulp.task('watch-dev',['clear_build_folder'], function () {
   liveReload.listen();
    gulp.start('copy-styles','copy-scripts','copy-html','copy-images','copy-fonts');
    gulp.watch(config.assets_path+'/**',['copy-styles', 'copy-scripts','copy-html']);
});


/*elixir(function(mix) {
    mix.sass('app.scss');
});*/
