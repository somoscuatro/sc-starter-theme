import * as tailwindColorPalette from "./tailwind.colors.json";
import * as tailwindBgColorsSafeList from "./tailwind.bg-colors-safelist.json";

module.exports = {
	content: [
		"./src/**/*.{php,twig}",
		"./templates/**/*.twig",
		"./assets/**/*.js",
	],
	theme: {
		extend: {
			colors: tailwindColorPalette,
		},
	},
	plugins: [],
	safelist: [...tailwindBgColorsSafeList.colors],
};
