# Appzio action example for PHP Library 2

This is a base code for creating a new action for Appzio platform using PHP. 

#### Documentation
Full documentation for the this example action can be found from: http://docs.appzio.com/php-toolkit-example/

Documentation for the PHP Library 2 can be found from: http://docs.appzio.com/php-toolkit/

#### Installing PHP Library 2
Please install https://github.com/appzio/action-bootstrap2 to your project to include all the components.

#### Installing Yii
You don't need the Yii installed, but it will make your life little bit easier if you are using a proper IDE.  

## Actions
Appzio applications are built from building blocks that are called actions. Action can provide only a single view or it can have a complete application logic on its own. Actions are organized in Appzio's web dashboard where the actions can be triggered depending on user's flow. Web dashboard provides also content management, menu management, translations any many other features. 

### MVC model
Appzio PHP Library 2 uses MVC model with a majority of the view parts rendered from components. While you can write your entire action without using custom components, its recommended to separate bigger view blocks into their own components. You will not come to regret doing this, as reusing and repurposing different view parts becomes much easier with components.

#### Controllers
Controller should be strictly for routing and passing data from model to views.

#### Views
Views return the actual view code with data provided by controller and with a help of the components.

#### Models
All business logic and data accessing belongs to models. This is where you do also data validation and save any validation errors.

### Action's file structure
Action must include all the directories included in this example action. And all files need to have namespaces for your action and theme set correctly. 

### Styles
While all other directories can be found both in the main level and theme, the styles directory belongs only to the action's theme. It's setup like this to avoid confusions with style inheritance and overriding. Note that your application will have styles also from other actions, from components, built-in styles and application's main style definitions. Hence it is recommended to use style naming which is specific to your action to avoid collisions.