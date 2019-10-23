# javanile/forward

[![StyleCI](https://github.styleci.io/repos/214412050/shield?branch=master)](https://github.styleci.io/repos/214412050)
[![Build Status](https://travis-ci.org/javanile/forward.svg?branch=master)](https://travis-ci.org/javanile/forward)
[![codecov](https://codecov.io/gh/javanile/forward/branch/master/graph/badge.svg)](https://codecov.io/gh/javanile/forward)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/07708c2e6c87463d90eb33a2d184483f)](https://www.codacy.com/manual/francescobianco/forward?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=javanile/forward&amp;utm_campaign=Badge_Grade)

Forward your artefacts or your reports via email from your CI/CD pipeline.
With `javanile/forward` microservice you could send by email the output of your favourite pipeline platforms like:
GitLab, BitBucket, Travis-CI, Jenkins, etc...

## Installation

1. Place `javanile/forward` inside any PHP server with virtual host over `public/` directory.
2. Copy `config.sample.php` to `config.php` and set your mail server settings.
3. Create a pair with `Hash` and `Token` based on secret passphrase and recipient email

## Hash and Token

Sinply create an `Hash` to blind your secret passphrase to hosting maintainers
```bash
$ php bin/hash <my-secret-passphrase>
# b3598964c6788457cf7108dcbbb30da67d9121d74501f990b0a4476154768ba6 
# (copy & paste into config.php file)
```

Next create a `Token` ready to grant email forwarding to the recipient
```bash
$ php bin/token <recipient-email> <my-secret-passphrase>
# b3598964c6788457cf7108dcbbb30da67d9121d74501f990b0a4476154768ba6 
# (copy & paste into cURL command)
```

## Send first email

When finish installation you try to send email via CURL
```bash
curl -L "https://forwarding.myserver.dev" \
     -H "To: admin@admin.dev" \
     -H "Token: b3598964c6788457cf7108dcbbb30da67d9121d74501f990b0a4476154768ba6" \
     -H "Subject: Nightly Release" \
     -F "release=@release-nightly.zip"     
```

## Examples

### GitLab sofware release
```


```

### GitLab code quality report
```


```

### BitBucket sofware release
```


```

### Travis-CI code quality report
```


```

### Travis-CI code quality report
```


```

### Jenkins code quality report
```


```

### Jenkins code quality report
```


```
