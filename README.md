IssueCreator
======

[![Author](http://img.shields.io/badge/author-@kylesamaniego-blue.svg?style=flat-square)](https://twitter.com/KyleSamaniego)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Version](http://img.shields.io/badge/version-1.0.0-blue.svg?style=flat-square)](https://twitter.com/KyleSamaniego)

IssueCreator is a general purpose PHP CLI bug poster that's fast, easy to use, and flexible.  

General Use:

    Github
    
      create-issue.php -u username -p password https://api.github.com/repos/{ownerName}/{repoName} "Here's the issue" "Here's what I do to recreate it"
    
    Bitbucket
    
      create-issue.php -u username -p password https://bitbucket.org/api/1.0/repositories/{accountname}/{repo_slug} "Here's the issue" "Here's what I do to recreate it"
 

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
