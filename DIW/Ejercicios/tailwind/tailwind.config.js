/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.html"],
  theme: {
    extend: {
      backgroundImage: {
        "body-pattern": "url('../recursos/img/pattern.png')",
      },
      colors: {
        "azul-claro": "#84b6f4",
        "azul-oscuro": "#005187",
      },
      animation: {
        "spin-slow": "spin 3s linear infinite",
        miWiggle: "wiggle 2s linear infinite",
      },
      keyframes: {
        wiggle: {
          "0%, 100%": { transform: "rotate(-3deg)" },
          "50%": { transform: "rotate(3deg)" },
        },
      },
      screens: {
        xs: { max: "768px" },
        // => @media (max-width: 768px) { ... }
        xs: { 'min': '640px', 'max': '767px' },
        // => @media (min-width: 640px and max-width: 767px) { ... }
      },
      boxShadow: {
        header3D: "0px 1px #393d3f,1px 2px 0px #393d3f,2px 3px 0px #393d3f,3px 4px 0px #393d3f",
        box: "0px 0px 1px rgba(0,0,0,0.3),0px 3px 7px rgba(0,0,0,0.3),0px 1px white inset, 0px - 3px 1px rgba(0,0,0,0.3) inset",
      },
    },
  },
  plugins: [],
}
