import twigTemplate from './template.twig';

import { faker } from '@faker-js/faker';

export default {
	title: 'Gutenberg Blocks/Sample',
	tags: ['autodocs'],
	argTypes: {
		heading: {
			description: 'The block heading.',
			type: 'string',
		},
		text: {
			description: 'The block text.',
			type: 'string',
		},
		button: {
			description:
				'The block button object. See Components/Button for more info.',
			type: 'object',
		},
		image: {
			description:
				'The block image object. See Components/Image for more info.',
			type: 'object',
		},
	},
};

const Template = (args) => {
	const template = twigTemplate(args);
	return template;
};

export const Default = Template.bind({});
Default.args = {
	heading: faker.lorem.sentence,
	text: faker.lorem.paragraph,
	button: {
		title: 'Click Me',
		url: '#',
		target: '_self',
	},
	image: {
		placeholder: true,
		url: faker.image.urlLoremFlickr({ category: 'abstract' }),
		width: 680,
		height: 453,
	},
};
