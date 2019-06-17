# Overview
- implement a HTTP health check API that can be hit to perform basic application diagnostics
- application instance health check
- application release health check

## Setup Health Check

```
use wanmigs\HealthCheck\SystemCheck;

$system = new SystemCheck();
```

## Health Check API

### `$system->getStatus()`

results :
```
{
    'status': 'OK'
    'timestamp': '2019-06-14T04:01:03Z00:00'
    'instance-id': '<hostname>'
}
```


### `$system->getReleaseInfo()`

Details :
- php version
- php component checks
- information stored from `build.json` generated from CI build

Release Health Check URL :



sample results :
```
{
    'timestamp': '2019-06-14T04:01:03Z00:00'
    'instance-id': '<hostname>'
    'php-version': 'php7.2'
    'php-modules': [
        'mbstring',
        . . .
    ],
    'branch': '<git-branch>',
    'release': '<git-relesae-tag>',
    'commit': '<git-commit-id>',
    'build': '<CI-build-id>'
    'config': '<configuration-id-from-CD>'
}
```

Details :
- information stored from `build.json` generated from CI build
- database information stored in database

## Defining `build.json` path

### Option 1
### env `GIT_BUILD_FILE_PATH`

### Option 2 
### `$system->setBuildPath($path_to_build_json);`

#### file resource :

`build.json`

```
{
    'start': '2019-06-14T04:01:03Z00:00'
    'end': '2019-06-14T04:01:03Z00:00',
    'status': 'SUCCESS',
    'branch': '<git-branch>',
    'release': '<git-relesae-tag>',
    'commit': '<git-commit-id>',
    'build': '<CI-build-id>'
    'config': '<configuration-id-from-CD>'
}

```
