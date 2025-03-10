window.addEventListener('load', () => {
  acf.add_filter('color_picker_args', function( args, field ){
    args.palettes = ['#0B0C0F', '#353945', '#777E90', '#C69BFF', '#FFFFFF'];

    return args;

  });
});
