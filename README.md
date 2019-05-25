# CTF Style Laravel Pentesting Excercise

This exercise has been test driven and developed on MacOS & Docker.  
  
Any other configurations will certainly need tweaking in certain parts, so be prepared to debug as you go along.  
  
Debian based distros like Ubuntu and Kali Linux should work pretty well.    

Basic PHP, Docker, *nix cli and Laravel knowledge are a must for this exercise.    
If you're lacking any of these, prepare to learn and tackle _a lot of_ issues as you proceed with this exercise.  

# !! Disclaimer !!
This is **NOT** a copy-paste style exercise.  

There are **actual** steps that you need to do and learn (_and to search Google, quite a bit actually_) in order to successfully complete the exercise.
    
The goal of this exercise is to teach you hands-on basic exploitation techniques that will threaten a poorly engineered PHP/Laravel application.  

By understanding how to exploit _stupid_ mistakes like not validating file uploads, or echoing user input raw into DOM, you'll hopefully be less likely to do these mistakes at your day-to-day life & work.    

## There are 5 different vulnerabilities & exploits included in this exercise.

1. Persistent XSS Attack
2. SQL Injection Attack
3. Password Cracking Attack (_Dictionary Attack_)
4. RCE through Malicious File Uploads
5. Privilege Escalation Attack

## Requirements
* Docker
* Docker Compose
* PHP (_>v7.1 preferably_) & Composer
* Yarn/npm
* nc (netcat)
* john (https://www.openwall.com/john/)
* sqlmap (http://sqlmap.org/)
* pspy (https://github.com/DominicBreuker/pspy)
* SecLists (https://github.com/danielmiessler/SecLists)
* Browser that runs Javascript & recognises `fetch()` without a polyfill, preferably Chrome/Firefox
* ~3GB of free disk space

## Installation & setup
* Navigate to project root, and run `docker-compose build` to build the application docker image
    * This will take while since we're compiling Apache v2.2.20 & php v7.1.29 manually as part of the docker image building process
* After the image has built successfully, start the app container & db container via running `docker-compose up -d`
    * Tweak exposed ports in `docker-compose.yaml` if ports `1234 && 33601` are already bound on your machine
* Install php dependencies via `composer install`
* `cp .env.example .env` to create the `.env` file
* Install JS dependencies via yarn/npm, eg `yarn` or `npm install`
* Build the JS bundle & compile Sass & Tailwind etc via `yarn dev` or `npm run dev`
* Migrate & seed the database
    * `docker exec laracon-app php /app/artisan migrate:fresh --seed `
* If everything went well you should see "Best Laravel Jobs" & a working front-page by navigating to `http://localhost:1234` in your browser
    * If you're unsure about modifying your local hosts file, please skip the following option.
    * You can optionally set a hostname by appending eg. `127.0.0.1 laravel-ctf.com` to `/etc/hosts`, and then access the app via `http://laravel-ctf.com:1234`
* When you're done, `docker-compose down` to stop & remove the containers of this exercise.
* You should also clean the locally built image (_it's ~1,85GB in size..._) by finding it via `docker image ls` and removing it via `docker image rm IMAGE_ID`

## XSS Attack
* Open a web server on your local machine
    * eg. `php -S localhost:8888`
* Find the company profile of 'Hacking Laravel Inc.' and send them a message via contact form
    * Wrap the content of `exploits/xss.js` in script tags and send that as the message part of the contact form
* Spy the user credentials from `DatabaseSeeder` and log in with those
* Open dev tools in your browser before logging in
* Log into the system with the credentials
* Make sure that you see a 404 error & CORS error on your console to know that the XSS attack script executed successfully (*do not log out or the cookie gets invalidated!*)
* See the authentication cookie being recorded into stdout/logfile by the web server that you started in step 1
* Open a new incognito browser window
* Navigate to http://localhost:1234 & open dev tools
* Replace the session cookie value with the token that you got
    * Make sure you copy *only* the token, not the URL encoded quotes around the actual value...
* Refresh your browser window
* Voilá, you've got initial foothold to the application now

## SQL Injection Attack
* While logged in with the stolen token, see where you can find a job list within the application
* By investigating the page you found, you should be able to find a jobs API URL endpoint (has a `?sort=` param in it)
* Test the API endpoint for SQLi vulnerabilities via `sqlmap -u api_url_that_you_found --batch --dbms=mysql` (_keep the URL param in_)
    * This can easily run for over 10 minutes if you're using docker-for-mac, be patient...
* You'll see 3 SQLi vulnerabilities listed if successful (_if not, go back and try harder_)
* See what options sqlmap has available via `sqlmap --help` & find a way to extract admin user's password hash
* Save the password hash into a file, that'll be required in the next step

## Password Attack (_Dictionary Based_)
* Run `john` with top 10,000 passwords list (from SecLists) & bcrypt format, pass in the hash obtained in previous step
* If you missed the password you can run `john` again with `--show` flag
* You should have the admin user's password now
* Switch to an admin account now to continue further

## Malicious File Uploads & Remote Code Execution
* With admin credentials you can find a file uploader in the application that's lacking proper file type validation
* Upload a backdoor / RCE script of your choice
    * Pro tip: try building your own script by combining `system()` & passing in an argument from a HTTP request via PHP's superglobals
* Find the file you uploaded, and invade the machine by spawning a reverse shell connection onto the target machine (http://pentestmonkey.net/cheat-sheet/shells/reverse-shell-cheat-sheet)
    * Pro tip: remember to URL encode the RCE payload to preserve control characters
* You should have a shell for user `daemon` now

## Privilege Escalation
* There's something interesting happening on the target machine *consistently*... Try enumerating with `pspy` and see if you can figure out what I'm referring to.
    * Yes, you'll need to find a way to get the script transferred onto the machine first. See what tools you've got at your disposal that suit the task at hand.
    * If you don't see anything after sniffing for over 10-minutes with `pspy`, restart the containers via `docker-compose restart` & try again
* Research your findings online, and find out how the process you discovered is being configured & operated
* Hijack the process and escalate to root privileged reverse shell session
* Congratulations, you've just rooted the machine & completed the exercise.

# Issues
Preferably open a PR directly rather than an issue if you find something wrong in the app and/or its documentation.  

As the license states this software comes "as is" with absolutely no warranty whatsoever, and therefor **isn't guaranteed** to be maintained and/or updated even if found faulty.

# Developing Further
Yes, eg. configuring a Selenium container (_via Laravel Dusk for example_) to trigger the XSS exploit code would be epic, rather than having to fire it manually like currently is the case.  

Feel free to open a PR for such if you get inspired.  
    
Feature wise however lets keep the application as it is, to not broaden its scope into an unmaintainable mess.

# License
MIT - see LICENSE file
