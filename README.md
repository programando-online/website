# Gerador de sites estáticos para o blog Programando

## Compile JS in terminal

```.\node_modules\.bin\esbuild ./app/layout/default/assets/js/input.js --bundle --outfile=./dist/assets/js/app.js ```

## Compile CSS in terminal
```npx tailwindcss -m -i ./app/layout/default/assets/css/input.css -o ./dist/assets/css/app.css --watch```

## Use script to build
```npm run build```