module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'nav': "url('/storage/assets/nav.svg')",
      },
      colors: {
        'secondary-color': '#800AF6',
      },
    },
  },
  plugins: [],
}