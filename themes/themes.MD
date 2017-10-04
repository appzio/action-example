# Themes

If your action could be used by different applications, its a good design practise to place any application specific code under the theme.

Be careful when defining new themes to set the namespaces correctly. Theme classes should always extend the main action classes and theme classes can override any of the actions main class methods.