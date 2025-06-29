
export default {
    darkMode: 'selector',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        montscairoerrat: ['Cairo', 'sans'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
