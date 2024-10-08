import { Alpine } from "/vendor/livewire/livewire/dist/livewire.esm";

Alpine.data(
    "consent_form",
    /** @param {Record<string,Record<string,boolean>>} initial */
    (initial) => {
        const categories = Object.keys(initial);
        const ids = Object.fromEntries(
            categories.map((category) => [
                category,
                Object.keys(initial[category]),
            ])
        );
        return {
            isDirty: false,
            isSubmitting: false,
            canRevoke: categories.some((category) =>
                ids[category].some((id) => initial[category][id])
            ),
            data: Object.fromEntries(
                Object.entries(initial).map(([category, services]) => [
                    category,
                    category === "essential"
                        ? Object.fromEntries(
                              Object.entries(services).map(([id]) => [id, true])
                          )
                        : services,
                ])
            ),
            /** @returns {void} */
            init() {
                this.$el.setAttribute("x-bind", "form");
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {void}
             */
            deselect(category, id) {
                if (category === "essential") return;
                if (!category) {
                    return categories.forEach((category) =>
                        this.deselect(category)
                    );
                }
                if (!id) {
                    return ids[category].forEach((id) =>
                        this.deselect(category, id)
                    );
                }
                if (this.data[category][id]) {
                    this.data[category][id] = false;
                    this.isDirty = false;
                }
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {void}
             */
            select(category, id) {
                if (category === "essential") return;
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
                if (!this.data[category][id]) {
                    this.data[category][id] = true;
                    this.isDirty = true;
                }
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
                const list = category ? [category] : categories;
                for (const category of list) {
                    if (category === "essential") continue;
                    for (const id of ids[category]) {
                        this.data[category][id] = !currentState;
                    }
                }
                this.isDirty = true;
            },
            /**
             * @param {?string} category
             * @param {?string} id
             * @returns {void}
             */
            toggle(category, id) {
                if (category === "essential") return;
                if (!id) return this.toggleAll(category);
                this.data[category][id] = !this.data[category][id];
                this.isDirty = true;
            },
            form: {
                /**
                 * @param {SubmitEvent} event
                 * @returns {void}
                 */
                async "@submit.prevent"(event) {
                    const intent = event.submitter?.name || true;
                    try {
                        this.isSubmitting = intent;
                        let result;
                        if (event.submitter.name === "revoke") {
                            this.deselect();
                            localStorage.clear();
                            sessionStorage.clear();
                            result = await fetch(this.$el.action, {
                                method: "DELETE",
                                headers: { Accept: "application/json" },
                            });
                        } else {
                            if (event.submitter.name === "accept-all") {
                                this.select();
                            }
                            result = await fetch(this.$el.action, {
                                method: "POST",
                                headers: {
                                    Accept: "application/json",
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    services: categories.flatMap((category) =>
                                        ids[category].filter(
                                            (id) =>
                                                category !== "essential" &&
                                                this.data[category][id]
                                        )
                                    ),
                                }),
                            });
                        }
                        if (result.status >= 400) {
                            let errorMessage = result.statusText;
                            try {
                                const json = await result.json();
                                errorMessage = json.message ?? errorMessage;
                            } catch (error) {
                                throw error;
                            }
                            alert(errorMessage);
                            this.isSubmitting = false;
                        } else {
                            window.location.reload();
                        }
                    } catch (error) {
                        console.error(error);
                        this.isSubmitting = false;
                    }
                },
            },
        };
    }
);
