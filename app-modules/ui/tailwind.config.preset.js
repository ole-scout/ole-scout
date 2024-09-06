import defaultColors from "tailwindcss/colors";
import { theme as defaultTheme } from "tailwindcss/defaultConfig";
import { formatColor, parseColor } from "tailwindcss/lib/util/color";
import flattenColors from "tailwindcss/lib/util/flattenColorPalette";
import plugin from "tailwindcss/plugin";

export default {
    theme: {
        extend: {
            fontFamily: {
                sans: ["'Inter'", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: "rgba(var(--brand-50), <alpha-value>)",
                    100: "rgba(var(--brand-100), <alpha-value>)",
                    200: "rgba(var(--brand-200), <alpha-value>)",
                    300: "rgba(var(--brand-300), <alpha-value>)",
                    400: "rgba(var(--brand-400), <alpha-value>)",
                    500: "rgba(var(--brand-500), <alpha-value>)",
                    600: "rgba(var(--brand-600), <alpha-value>)",
                    700: "rgba(var(--brand-700), <alpha-value>)",
                    800: "rgba(var(--brand-800), <alpha-value>)",
                    900: "rgba(var(--brand-900), <alpha-value>)",
                    950: "rgba(var(--brand-950), <alpha-value>)",
                },
                primary: {
                    50: "rgba(var(--primary-50), <alpha-value>)",
                    100: "rgba(var(--primary-100), <alpha-value>)",
                    200: "rgba(var(--primary-200), <alpha-value>)",
                    300: "rgba(var(--primary-300), <alpha-value>)",
                    400: "rgba(var(--primary-400), <alpha-value>)",
                    500: "rgba(var(--primary-500), <alpha-value>)",
                    600: "rgba(var(--primary-600), <alpha-value>)",
                    700: "rgba(var(--primary-700), <alpha-value>)",
                    800: "rgba(var(--primary-800), <alpha-value>)",
                    900: "rgba(var(--primary-900), <alpha-value>)",
                    950: "rgba(var(--primary-950), <alpha-value>)",
                },
                success: defaultColors.green,
                danger: defaultColors.red,
                neutral: defaultColors.neutral,
                gray: defaultColors.zinc,
            },
        },
    },
    plugins: [
        plugin(function ({ matchUtilities, theme }) {
            const colors = theme("colors");
            const setAlpha = (value, alpha) =>
                formatColor({
                    ...parseColor(value.replace("<alpha-value>", "1")),
                    alpha,
                });
            matchUtilities(
                {
                    "shadow-border": (value) => ({
                        boxShadow: String(
                            [
                                `inset 0 0 0 1px ${
                                    typeof value === "string"
                                        ? value
                                        : value({ opacityValue: 0.15 })
                                }`,
                                "var(--tw-ring-offset-shadow)",
                                "var(--tw-ring-shadow)",
                                "var(--tw-shadow)",
                            ].filter(Boolean)
                        ),
                    }),
                },
                {
                    type: "color",
                    values: flattenColors(colors),
                }
            );
            matchUtilities(
                {
                    "shadow-sheen": (value) => {
                        return {
                            boxShadow: String([
                                `inset 0 1px ${
                                    typeof value === "string"
                                        ? value
                                        : setAlpha(value[900], 0.15)
                                }`,
                                `inset 0 2px ${
                                    typeof value === "string"
                                        ? value
                                        : setAlpha(value[50], 0.25)
                                }`,
                                "var(--tw-ring-offset-shadow)",
                                "var(--tw-ring-shadow)",
                                "var(--tw-shadow)",
                            ]),
                        };
                    },
                },
                {
                    values: Object.fromEntries([
                        ["none", "transparent"],
                        ...Object.entries(theme("colors")).flatMap(
                            ([color, value]) =>
                                typeof value === "string"
                                    ? []
                                    : [[color, value]]
                        ),
                    ]),
                }
            );
        }),
    ],
};
