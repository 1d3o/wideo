# Wideo

Wideo works with Node.js.

On the first startup (**npm run start**) it creates a **.wideo.json** file inside the theme directory. This if file is used as theme configuration.

## Configuration

The **.wideo.json** configuration file has this structure:

```json
{
  "ignoreFiles": [ // List of files and directories that should be ignored on build
    ".wideo.json",
    "webpack.config.js",
    "README.md",
    "package.json",
    "package-lock.json",
    "yarn.lock",
    ".gitignore",
    "src",
    "build",
    "node_modules",
    "bower_components",
    ".git",
    "docs",
    "bin",
    "docker-compose.yml",
    ".dockerignore",
    "docker"
  ]
}
```

## Compilation

The project can be compiled with the **npm run build** command. The execution of the command creates a **./build** directory containing the builded theme.
