# emailasusername
Two Joomla Plugins (A system plugin and authentication plugin) Which together removes usernames from the registration and login pages of Joomla and other Joomla extensions.

# History
A plugin which I started many years ago, just as Joomla 1.5 was released. 

# How it works
It leverages template overrides to hide the (mandatory) username in Joomla, and then a system plugin silently intercepts posts involving registration & automatically generates a unique username (site wide) so that the input passes the registration validation. As far as the user sees, they have only had to supply (at minimum) an email address and password, Joomla sees the user has submitted a username (because the system plugin has silently generated one), email address and password. 

# What about system generated emails?
These are handled by installing language overrides. However because of the way the Joomla user controller is programmed, it is impossible to include the users email address in the email (as a username would appear) Because the users email address is not supplied to the function (a printf) which renders the email text. Of course this could be done with a core hack, but those should be avoided at all costs, and in my experience makes a site basically un-maintainable.

# Architecture
emailasusername.php is the entry point, which extends apollo.php (apollo.php was a base class which was intended to form the basis of other plugins which never materialised for various reasons)
from there it uses the URL to decipher which "controller" to load. Note that controllers are "Email as username controllers" Not Joomla Controllers. Controllers are organised by extension, and stored in the accociated directory in the template_overrides directory/
Each controller inherits lunarExtension which provides functions / properties required by all controllers.
This is also where the username generation, and injection into post data occurrs.
The actuall template overrides are stored in the folder named after the version (e.g. 3.0.0) This allows it to support multiple versions of multiple extensions.

# You said there are two plugins
That right, while the system plugin handles the UI and 

# Future
Basically none. I posted it here so the code could "live on" & anyone that wants to modify it for thier own needs can. Unfortunately, I just dont have the time to devote to it anymore!
