module.exports = {
  purge: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue"
  ],
  darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            backgroundImage: theme => ({
                'project-picture': "url('../images/christine-roy-unsplash.jpg')"
            }),
        },
    },
  variants: {
    extend: {},
  },
  plugins: [],
}
