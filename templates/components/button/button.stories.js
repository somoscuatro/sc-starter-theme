import twigTemplate from './template.twig';

export default {
	title: 'Components/Button',
	tags: ['autodocs'],
	argTypes: {
		type: {
			description:
				'The type of the button. The default type is `primary`.',
			options: [
				'primary',
				'secondary',
				'hollow_light',
				'hollow_dark',
				'link',
			],
			control: { type: 'select' },
		},
		id: {
			description: 'The unique identifier of the button element.',
			type: 'string',
		},
		classes: {
			description:
				'A space-separated list of CSS class names to apply to the button.',
			type: 'string',
		},
		title: {
			description: 'The string displayed on the button.',
			type: 'string',
		},
		url: {
			description: 'The URL that the button will link to when clicked.',
			type: 'string',
		},
		target: {
			description:
				'Specifies where to open the linked URL. Use `_self` for the same frame or `_blank` for a new tab or window.',
			options: ['_self', '_blank'],
			type: 'select',
		},
		attrs: {
			description:
				'Additional HTML attributes to be added to the button element in an object format.',
			type: 'string',
		},
	},
};

const Template = (args) => {
	const template = twigTemplate(args);
	return template;
};

export const Default = Template.bind({});
Default.args = {
	type: 'primary',
	title: 'Button Text',
	url: '#',
	target: '_self',
};
