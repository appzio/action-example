# Themes

If your action could be used by different applications, its a good design practise to place any application specific code under the theme.

Be careful when defining new themes to set the namespaces correctly. Theme classes should always extend the main action classes and theme classes can override any of the actions main class methods.

# Troubleshooting

When you create your new action you should always save it in the admin before running your code. Especially if you are using a theme.
If not you may experience errors related to incorrect namespacing or missing slashes in class paths.
This is caused by the parser looking for a theme and not finding it.