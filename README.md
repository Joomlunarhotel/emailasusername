# emailasusername
A Joomla Plugin Which removes usernames from the registration pages of Joomla and other extensions

# History
A plugin which I started many years ago, just as Joomla 1.5 was released. 

# How it works
It leverages template overrides to hide the (mandatory) username in Joomla, and then a system plugin silently intercepts posts involving registration & automatically generates a unique username (site wide) so that Joomla is happy with the registration. As far as the user sees, they have only had to supply (minimum) an email address and password, Joomla sees the user has submitted a username, email address and password. 

# Architecture
emailasusername.php is the entry point, which extends apollo.php (apollo.php was a base class which was intended to form the basis of other plugins which never materialised for various reasons)
from there it uses the URL to decipher which "controller" to load. Note that controllers are "Email as username controllers" Not Joomla Controllers. Controllers are organised by extension, and stored in template_overrides.
Each controller inherits lunarExtension which provides functions / properties required by all controllers.
This is also where the username generation, and injection into post data occurrs.
The actuall template overrides are stored in the folder named after the version (e.g. 3.0.0) This allows it to support multiple versions of multiple extensions.

# Future
Basically none. I posted it here so the code could "live on" & anyone that wants to modify it for thier own needs can. Unfortunately, I just dont have the time to devote to it anymore!
