const { __ } = wp.i18n;
const { Fragment, useState, useEffect } = wp.element;
const {
	PanelBody,
	PanelRow,
	ToggleControl,
} = wp.components;
const { withDispatch } = wp.data;
const { PanelColorSettings } = wp.blockEditor;

const Sidebar = (props) => {
	const [enabled, setEnabled] = useState(false);
	const [bodyColor, setBodyColor] = useState(false);

	/* Initialize the initial state */
	useEffect(() => {
		const {
			_wpajax_enable_landing_template,
			_wpajax_set_body_color,
		} = wp.data.select("core/editor").getEditedPostAttribute("meta");
		if (
			_wpajax_enable_landing_template != null &&
			_wpajax_enable_landing_template.length != 0
		) {
			setEnabled(_wpajax_enable_landing_template);
		} else {
			setEnabled(false);
		}

		if (_wpajax_set_body_color != null && _wpajax_set_body_color.length != 0) {
			setBodyColor(_wpajax_set_body_color);
		} else {
			setBodyColor("");
		}
	}, []);
	return (
		<Fragment>
			<PanelBody title={__('Landing Template', 'landing-page-gutenberg-template')}>
				<PanelRow>
					<ToggleControl
						label={__(
							"Enable Landing Page Template",
							"landing-page-gutenberg-template"
						)}
						checked={enabled}
						onChange={(value) => {
							props.setMetaFieldValue("_wpajax_enable_landing_template", value);
							setEnabled(value);
						}}
					/>
				</PanelRow>
				{enabled && (
					<Fragment>
						<PanelRow>
							<PanelColorSettings
								title={ __( 'Colors', 'landing-page-gutenberg-template' ) }
								initialOpen={ true }
								colorSettings={ [ {
									value: bodyColor,
									onChange: ( value ) => {
										props.setMetaFieldValue("_wpajax_set_body_color", value);
									setBodyColor(value);
									},
									label: __( 'Select a Body Background Color', 'landing-page-gutenberg-template' ),
								} ] }
							/>
						</PanelRow>
					</Fragment>
				)}
				</PanelBody>
		</Fragment>
	);
};

export default withDispatch((dispatch) => {
	return {
		setMetaFieldValue: function (key, value) {
			dispatch("core/editor").editPost({ meta: { [key]: value } });
		},
	};
})(Sidebar);
