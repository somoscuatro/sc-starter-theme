const fs = require('fs');
const mix = require('laravel-mix');

mix.setPublicPath('dist');
mix.setResourceRoot('../');

const fontsDir = 'assets/fonts';
const stylesDir = 'assets/styles';
const scriptsDir = 'assets/scripts';
const scriptsVendorDir = 'assets/scripts/vendor';

const discover = (dirs, type, excludedDirs = []) => {
	let files = [];

	dirs.forEach((dir) => {
		if (excludedDirs.indexOf(dir) === -1) {
			fs.readdirSync(dir).forEach((node) => {
				const nodePath = `${dir}/${node}`;
				if (fs.statSync(nodePath).isFile()) {
					if (
						nodePath.endsWith(type) &&
						!node.startsWith('.') &&
						!node.startsWith('_')
					) {
						files.push(nodePath);
					}
				} else {
					files = files.concat(discover([nodePath], type));
				}
			});
		}
	});

	return files;
};

if (fs.existsSync(fontsDir)) {
	discover([fontsDir], '.woff2').forEach((file) => {
		mix.copy(file, 'dist/fonts');
	});
}

if (fs.existsSync(scriptsVendorDir)) {
	discover([scriptsVendorDir], '.js').forEach((file) => {
		mix.copy(file, 'dist/scripts/vendor');
	});
}

if (fs.existsSync(scriptsDir)) {
	discover(['src/blocks', scriptsDir], '.js', ['vendor'])
		.filter((file) => !file.endsWith('stories.js')) // Exclude files ending with 'stories.js'
		.forEach((file) => {
			mix.js(file, 'scripts');
		});
}

if (fs.existsSync(stylesDir)) {
	discover(['assets/styles'], '.css').forEach((file) => {
		mix.postCss(file, 'styles', [
			require('postcss-import'),
			require('postcss-extend'),
			require('tailwindcss/nesting'),
			require('tailwindcss'),
		]);
	});
}
