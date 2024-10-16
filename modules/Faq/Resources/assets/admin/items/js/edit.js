import Alpine from "alpinejs";
import tinyMce from "@admin/js/wysiwyg";
import Errors from "@admin/js/Errors";
import { nprogress } from "@admin/js/NProgress";

window.Alpine = Alpine;

let textEditor;

Alpine.data("postEdit", ({ formData = {}}) => ({
    formSubmitting: false,
    formSubmissionType: null,
    form: {
        ...formData,
    },
    errors: new Errors(),

    init() {

        nprogress();

        this.fullscreenMode();

        textEditor = this.initTinyMce();
    },

    fullscreenMode() {
        $(".fullscreen-mode-open").on("click", (e) => {
            e.preventDefault();

            if (!document.fullscreenElement) {
                $(".fullscreen-mode-open .fullscreen-one").removeClass(
                    "exit-full-screen"
                );
                $(".fullscreen-mode-open .fullscreen-two").addClass(
                    "enter-full-screen"
                );

                document.documentElement.requestFullscreen().catch((err) => {
                    alert(
                        `Error attempting to enable full-screen mode: ${err.message} (${err.name})`
                    );
                });
            } else {
                $(".fullscreen-mode-open .fullscreen-two").removeClass(
                    "enter-full-screen"
                );
                $(".fullscreen-mode-open .fullscreen-one").addClass(
                    "exit-full-screen"
                );

                document.exitFullscreen().catch((err) => {
                    alert(
                        `Error attempting to disable full-screen mode: ${err.message} (${err.name})`
                    );
                });
            }
        });
    },

    initTinyMce() {
        return tinyMce({
            setup: (editor) => {
                editor.on("change", () => {
                    editor.save();
                    editor.getElement().dispatchEvent(new Event("input"));

                    this.errors.clear("description");
                });
            },
        });
    },


    focusDescriptionField() {
        textEditor.get("description").focus();
    },


    focusFirstErrorField(formElements) {
        const errorKeys = Object.keys(this.errors.errors);

        const firstErrorField = [...formElements].find((element) => {
            return errorKeys.includes(element.name);
        });

        if (firstErrorField.classList.contains("wysiwyg")) {
            textEditor.get(firstErrorField.getAttribute("name")).focus();

            return;
        }

        firstErrorField.focus();
    },

    handleSubmit({ submissionType }) {
        this.formSubmitting = true;
        this.formSubmissionType = submissionType;

        const {
            id,
            name,
            description,
            slug,
            publish_status,
            faq_id,
        } = this.form;

        $.ajax({
            type: "PUT",
            url: route("admin.faq.update", {
                id: this.form.id,
                ...(submissionType === "save_and_exit" && {
                    exit_flash: true,
                }),
            }),
            data: {
                id,
                name,
                description,
                slug,
                publish_status,
                faq_id,
            },
            dataType: "json",
            success: ({ message }) => {
                if (submissionType === "save_and_exit") {
                    location.href = route("admin.faq.index");

                    return;
                }

                success(message);
            },
        })
            .catch(({ responseJSON }) => {
                this.errors.reset();
                this.errors.record(responseJSON.errors);
                this.focusFirstErrorField(this.$refs.form.elements);

                error(responseJSON.message);
            })
            .always(() => {
                this.formSubmitting = false;
                this.formSubmissionType = null;
            });
    },
}));

Alpine.start();
