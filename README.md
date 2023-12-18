# Typecho Plugin Template

This is a template for developing Typecho plugins.

[中文说明](README.zh-CN.md)

## How to Use

Click the "Use this template" button to create a new repository from this template.

## Suggested Directory Structure

```
LICENSE
README.md
/plugin
    ├── Plugin.php
    ├── ...
```

All source code should be placed in the `/plugin` directory.

## Plugin.php

The `Plugin.php` file is the main file of the plugin. It should contain a class named `Plugin` which implements the `Typecho\Plugin\PluginInterface` interface.

```php

namespace TypechoPlugin\Example;

use Typecho\Plugin\PluginInterface;

/**
 * Example plugin.
 *
 * @package Example
 * @author Typecho
 * @version %version%
 * @link https://typecho.org
 */
class Plugin implements PluginInterface
{
    // Methods to implement the PluginInterface.
}
```

⚠️ Important notes:

- The namespace of the plugin should be `TypechoPlugin\{PluginName}`. For example, if the plugin name is `Example`, the namespace should be `TypechoPlugin\Example`. This is required for the plugin to be loaded by Typecho.
- The version of the plugin should be replaced with `%version%`. The version number will be replaced by the build script automatically. **Do not** replace the version number manually.

Naming rules:

- The plugin name should contain only letters, numbers.
- The plugin name should be in PascalCase.

Examples:

- `Example` is a valid plugin name.
- `ExamplePlugin` is a valid plugin name.
- `Example-Plugin` is not a valid plugin name.
- `Example_Plugin` is not a valid plugin name.

## Debugging & Development

Use soft links to link the plugin directory to the `usr/plugins` directory of Typecho.

For example, if here is the directory structure of the plugin project and the Typecho project:

```
/path/to/plugin
    ├── /plugin
    │   ├── Plugin.php
    │   ├── ...
    │   └── ...
    └── ...
/path/to/typecho
    ├── /usr
    │   ├── /plugins
    │   │   ├── /Example
    │   │   │   ├── Plugin.php
    │   │   │   ├── ...
    │   │   │   └── ...
    │   │   └── ...
    │   └── ...
    └── ...
```

Run the following command in the `/path/to/typecho/usr/plugins` directory:

```bash
ln -s /path/to/plugin/plugin Example
```

Then you can debug and develop the plugin in the `/path/to/plugin` directory. The plugin directory name `Example` is the same as the plugin name.

Note: If you are using Windows, you can use [mklink](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/mklink) to create soft links.

## Release Steps

Create a release on GitHub and name a tag with the version number. For example, if the version number is `1.0.0`, the tag name should be `1.0.0` or `v1.0.0`.

The build script will automatically create a zip file for the release and upload it to the release page.