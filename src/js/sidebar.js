const { __ } = wp.i18n;
const { Fragment, useState, useEffect } = wp.element;
const {
	PanelRow,
	TextControl,
	ToggleControl,
} = wp.components;
const { withDispatch } = wp.data;
const { PanelColorSettings } = wp.blockEditor;

const Sidebar = (props) => {
	const [enabled, setEnabled] = useState(false);
	const [disableCSS, setDisableCSS] = useState(false);
	const [bodyClass, setBodyClass] = useState(false);
	const [bodyColor, setBodyColor] = useState(false);

	/* Initialize the initial state */
	useEffect(() => {
		const {
			_wpajax_enable_landing_template,
			_wpajax_disable_theme_stylesheet,
			_wpajax_set_body_class,
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

		if (
			_wpajax_disable_theme_stylesheet != null &&
			_wpajax_disable_theme_stylesheet.length != 0
		) {
			setDisableCSS(_wpajax_disable_theme_stylesheet);
		} else {
			setDisableCSS(false);
		}

		if (_wpajax_set_body_class != null && _wpajax_set_body_class.length != 0) {
			setBodyClass(_wpajax_set_body_class);
		} else {
			setBodyClass("");
		}

		if (_wpajax_set_body_color != null && _wpajax_set_body_color.length != 0) {
			setBodyColor(_wpajax_set_body_color);
		} else {
			setBodyColor("");
		}
	}, []);
	return (
		<Fragment>
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
							<ToggleControl
								label={__(
									"Disable the Theme Stylesheet (Optional)",
									"landing-page-gutenberg-template"
								)}
								checked={disableCSS}
								onChange={(value) => {
									props.setMetaFieldValue(
										"_wpajax_disable_theme_stylesheet",
										value
									);
									setDisableCSS(value);
								}}
							/>
						</PanelRow>
						<PanelRow>
							<TextControl
								label={__("Enter a Body Class (Optional)", "landing-page-gutenberg-template")}
								placeholder={"my-class-name"}
								value={bodyClass}
								onChange={(value) => {
									props.setMetaFieldValue("_wpajax_set_body_class", value);
									setBodyClass(value);
								}}
							/>
						</PanelRow>
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
