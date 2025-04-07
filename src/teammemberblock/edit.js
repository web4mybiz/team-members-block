/**
 * External dependencies
 */
import ServerSideRender from '@wordpress/server-side-render';

/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { PanelBody, RangeControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Block edit component
 */

const Edit = ( props ) => {
    const { attributes, setAttributes, name } = props;
    const { limit } = attributes;

    return (
        <div { ...useBlockProps() }>
            <InspectorControls>
                <PanelBody title={ __( 'Team Member Settings', 'team-members' ) }>
                    <RangeControl
                        label={ __( 'Number of Members', 'team-members' ) }
                        value={ limit }
                        onChange={ ( value ) => {
                            const sanitizedValue = Math.max(1, Math.min(20, parseInt(value, 10))); // Ensure the value is between 1 and 20
                            setAttributes({ limit: sanitizedValue });
                        } }
                    />
                </PanelBody>
            </InspectorControls>

            <ServerSideRender
                block={ name }
                attributes={ attributes }
            />
        </div>
    );
};

export default Edit;
