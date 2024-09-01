import defaultColors from "tailwindcss/colors";
import { formatColor, parseColor } from "tailwindcss/lib/util/color";
import plugin from "tailwindcss/plugin";

export default {
    theme: {
        extend: {
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
            const colors = Object.entries(theme("colors")).filter(([, value]) =>
                typeof value === "string"
                    ? parseColor(value) !== null
                    : Object.keys(value).length > 0
            );
            const singleColors = colors.flatMap(([color, value]) =>
                typeof value === "string"
                    ? [[color, value]]
                    : Object.entries(value).map(([shade, value]) => [
                          `${color}-${shade}`,
                          value,
                      ])
            );
            const getShadeCombos = (name1, color1, value1) =>
                colors.flatMap(([color2, value2]) => {
                    if (typeof value2 === "string") {
                        const name2 = color2;
                        if (name1 === name2) return [];
                        return [[`${name1}/${name2}`, [value1, value2]]];
                    }
                    // Only allow combos of shades of the same color
                    // or with single-shade colors (e.g. white or black)
                    if (name1 !== color1 && color1 !== color2) return [];
                    return Object.entries(value2).flatMap(
                        ([shade2, value2]) => {
                            let name2 = `${color2}-${shade2}`;
                            if (name1 === name2) return [];
                            if (color1 === color2) name2 = shade2;
                            return [[`${name1}/${name2}`, [value1, value2]]];
                        }
                    );
                });
            const shadeCombos = colors.flatMap(([color, value]) =>
                typeof value === "string"
                    ? getShadeCombos(color, color, value)
                    : Object.entries(value).flatMap(([shade, value]) =>
                          getShadeCombos(`${color}-${shade}`, color, value)
                      )
            );
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
                                value !== "none" &&
                                    `inset 0 0 0 1px ${setAlpha(value, 0.15)}`,
                                "var(--tw-ring-offset-shadow)",
                                "var(--tw-ring-shadow)",
                                "var(--tw-shadow)",
                            ].filter(Boolean)
                        ),
                    }),
                },
                {
                    values: Object.fromEntries([
                        ["none", "none"],
                        ...singleColors,
                    ]),
                }
            );
            matchUtilities(
                {
                    "shadow-sheen": (value) => ({
                        boxShadow: String(
                            [
                                value !== "none" && [
                                    `inset 0 1px ${setAlpha(value[0], 0.25)}`,
                                    `inset 0 2px ${setAlpha(value[1], 0.15)}`,
                                ],
                                "var(--tw-ring-offset-shadow)",
                                "var(--tw-ring-shadow)",
                                "var(--tw-shadow)",
                            ].filter(Boolean)
                        ),
                    }),
                },
                {
                    values: Object.fromEntries([
                        ["none", "none"],
                        ...shadeCombos,
                    ]),
                }
            );
        }),
    ],
};
