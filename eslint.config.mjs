import eslint from "@eslint/js";
import tseslint from "typescript-eslint";

export default tseslint.config(
    eslint.configs.recommended,
    ...tseslint.configs.recommended
);

// import globals from "globals";
// import pluginJs from "@eslint/js";
// import tseslint from "typescript-eslint";
// import pluginVue from "eslint-plugin-vue";

// export default [
//     {
//         files: ["resources/js/*.{js,mjs,cjs,ts,vue}"],
//         rules: {
//             "vue/multi-word-component-names": "off",
//         },
//         languageOptions:{
//           parserOptions:{
//             "parser":  "@typescript-eslint/parser"
//           }
//         }
//     },
//     { languageOptions: { globals: globals.browser } },
//     pluginJs.configs.recommended,
//     ...tseslint.configs.recommended,
//     ...pluginVue.configs["flat/essential"],
//     {
//         files: ["resources/js/*.vue"],
//         languageOptions: { parserOptions: { parser: tseslint.parser } },
//     },
// ];
