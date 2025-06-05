/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: "#000000",
        "primary-dark": "#1a1a1a",
        secondary: "#ffffff",
        accent: "#333333",
        "accent-dark": "#4a4a4a",
        text: "#4a4a4a",
      },
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
      },
      height: {
        header: "80px",
      },
      spacing: {
        section: "80px",
      },
      boxShadow: {
        card: "0 2px 15px rgba(0, 0, 0, 0.1)",
      },
      animation: {
        "fade-in": "fadeIn 0.5s ease-in-out forwards",
        "slide-down": "slideDown 0.3s ease-in-out forwards",
        "bounce-delayed": "bounce 1s infinite 0.2s",
      },
      keyframes: {
        fadeIn: {
          "0%": { opacity: "0", transform: "translateY(20px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        slideDown: {
          "0%": { opacity: "0", transform: "translateY(-10px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
      },
      transitionProperty: {
        height: "height",
        spacing: "margin, padding",
      },
    },
  },
  plugins: [
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/forms"),
  ],
  safelist: [
    "bg-primary",
    "text-primary",
    "bg-secondary",
    "text-secondary",
    "bg-accent",
    "text-accent",
  ],
};
