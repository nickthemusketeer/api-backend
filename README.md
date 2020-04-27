# api-backend
The backend API for coughdetect.

## Usage
Requires Apache.

Run ```composer dump-autoload -o``` in the project directory.

Serve the public folder with your webserver and make sure the webserver user has read access to all the files in this project.
 and write access to the resources/ directory.
 
To run the analysis send a POST request with the following structure:

```
Content-Type: audio/wav
Content-Length: length of the body in bytes
Body: Raw content of the wav file
```

The body must be raw content of a wav file otherwise it won't work.

### Optional
.gitkeep in the resources/ directory can optionally be deleted. It is just there so the folder gets tracked.

## For Developers
The entry point is public/index.php. This runs the init function which is located in Init/Init.php under the Init class.

Autoloading is done with PSR-4 in Composer.

Requires apache because of the usage of getallheaders() in src/API/ReceivedData.

Run ```composer dump-autoload -o``` to generate the autoload file from the composer.json

### Packages
No extra packages required so far.