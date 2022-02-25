# Interface Image Downloader
An application to get the href list, assets list and download all assets in img tag.

# setup
The application runs in any server capable of hosting php pages.
For a local setup 
1.install xammp in your system 
2.Place the code inside xammp/htdocs/IID
3.Start apache server on xampp 
4.open http://localhost/IID on browser

# scope of application

1.This is a php based application that can be used to download assets from a single page or a website.

2.The application tries to download all the assets insde the src of all img tags in a page.

3.The assets that cant be shown on browser can be seen in downloads folder


# Scenarios
1.The application can handle cases like absolute and relative path variations.
2.The application can differentiate and filter between internal and external links to only download content from internal links without repetition.


# unaddressed issues

1.base64 conversions, encrypted, other exceptions that might have caused failure in downloads

# Scope for Improvement 

1.Handling all errors.
2.user interface for end to end management of all the collected assets. 
