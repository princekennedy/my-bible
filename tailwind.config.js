module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      textColor: {
        primary: 'var(--color-primary)',
        secondary: 'var(--color-secondary)',
      },      
      backgroundColor: {
        primary: 'var(--background-primary)',
        secondary: 'var(--background-secondary)',
      },      
      borderColor: {
        primary: 'var(--border-primary)',
        secondary: 'var(--border-secondary)',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
