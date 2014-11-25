version 1.3.0
=============
**Date:** 25-Nov-2014

- (enh #6): Enhance `InputWidget` for attaching multiple jQuery plugins.

### BC Breaking Changes

#### Removed:
The following HTML5 data attributes are removed and not registered anymore with the input:

- `data-plugin-name` the name of the plugin
- `data-plugin-options` the client options of the plugin

#### Added:

Following functionality included in `InputWidget` and `Widget` classes:

- New protected property `_pluginName` for easy configuration in individual widgets.
- The following HTML5 data attribute will be added for each input:
    - `data-krajee-{name}` the client options of the plugin. The tag `{name}` will be replaced with the 
       registered jQuery plugin name (e.g. `select2`, `typeahead` etc.).
- New protected property `_dataVar` included for generating the above data attribute.


version 1.2.0
=============
**Date:** 25-Nov-2014

- (bug #2): AssetBundle::EMPTY_PATH is not setting sourcePath to null.
- (enh #3): Modify and validate language setting according to yii i18n.
- (enh #4): Add validations for html inputs, dropdowns, and widgets in `Config`.
- (enh #5): Correctly validate checkbox and radio checked states for `InputWidget`.

version 1.1.0
=============
**Date:** 10-Nov-2014

- Validation for sub repositories containing input widgets.
- (bug #1): Include namespaced FormatConverter class in InputWidget.
- Include `Html5Input` class and  `Html5InputAsset` bundle.
- Include `AnimateAsset` bundle.
- Code formatting as per standards.

version 1.0.0
=============
**Date:** 06-Nov-2014

Initial release