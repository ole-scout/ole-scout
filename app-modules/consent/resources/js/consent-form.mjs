import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

Alpine.data(
    "consent_form",
    /** @param {Record<string,Record<string,boolean>>} initial */
    (initial) => {
        const data = initial;
        const categories = Object.keys(data);
        const ids = Object.fromEntries(
            categories.map((category) => [
                category,
                Object.keys(data[category]),
            ])
        );
        return {
            data,
            init() {
                this.$el.setAttribute("x-bind", "form");
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {void}
             */
            select(category, id) {
                if (!category) {
                    return categories.forEach((category) =>
                        this.select(category)
                    );
                }
                if (!id) {
                    return ids[category].forEach((id) =>
                        this.select(category, id)
                    );
                }
                this.data[category][id] = true;
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {boolean}
             */
            isSelected(category, id) {
                if (!category) {
                    return categories.some((category) =>
                        this.isSelected(category)
                    );
                }
                if (!id) {
                    return ids[category].some((id) => this.data[category][id]);
                }
                return this.data[category][id];
            },
            /**
             * @param {?string} category
             * @returns {number}
             */
            countSelected(category) {
                if (!category) {
                    return categories.reduce(
                        (acc, category) => acc + this.countSelected(category),
                        0
                    );
                }
                return ids[category].filter((id) => this.data[category][id])
                    .length;
            },
            /**
             * @param {?string} category
             * @returns {boolean}
             */
            isAllSelected(category) {
                if (!category) {
                    return categories.every((category) =>
                        this.isAllSelected(category)
                    );
                }
                return ids[category].every((id) => this.data[category][id]);
            },
            /**
             * @param {?string} category
             * @returns {void}
             */
            toggleAll(category) {
                const currentState = this.isAllSelected(category);
                const categories = category ? [category] : categories;
                for (const category of categories) {
                    for (const id of ids[category]) {
                        this.data[category][id] = !currentState;
                    }
                }
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {void}
             */
            toggle(category, id) {
                if (!id) return this.toggleAll(category);
                this.data[category][id] = !this.data[category][id];
            },
            form: {
                async "@submit.prevent"(event) {
                    if (event.submitter.name === "accept-all") {
                        this.select();
                    }
                    try {
                        await fetch(this.$el.action, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify(
                                categories.flatMap((category) =>
                                    ids[category].filter(
                                        (id) => data[category][id]
                                    )
                                )
                            ),
                        });
                    } catch (error) {
                        console.error(error);
                        return;
                    }
                    this.$dispatch("consent-updated");
                },
            },
        };
    }
);
