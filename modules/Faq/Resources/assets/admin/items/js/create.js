import Alpine from "alpinejs";
import tinyMce from "@admin/js/wysiwyg";
import Errors from "@admin/js/Errors";
import { nprogress } from "@admin/js/NProgress";

window.Alpine = Alpine;

let textEditor;

Alpine.data("postCreate", () => ({
    formSubmitting: false,
    formSubmissionType: null,
    form: {
        name: "",
        description: "",
        publish_status: "published",
        faq_id: "",
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

    resetForm() {
        this.errors.reset();

        this.form = {
            name: "",
            description: "",
            publish_status: "published",
            faq_id: "",
        };

        textEditor.get("description").setContent("");
        textEditor.get("description").execCommand("mceCancel");
    },

    handleSubmit({ submissionType }) {
        this.formSubmitting = true;
        this.formSubmissionType = submissionType;

        const {
            name,
            description,
            publish_status,
            faq_id,
        } = this.form;

        $.ajax({
            type: "POST",
            url: route("admin.faq.store", {
                ...((submissionType === "save_and_edit" ||
                    submissionType === "save_and_exit") && {
                    exit_flash: true,
                }),
            }),
            data: {
                name,
                description,
                publish_status,
                faq_id,
            },
            dataType: "json",
            success: ({ message, faq_id }) => {
                if (this.formSubmissionType === "save_and_edit") {
                    location.href = route(
                        "admin.faq.edit",
                        faq_id
                    );

                    return;
                }

                if (this.formSubmissionType === "save_and_exit") {
                    location.href = route("admin.faq.index");

                    return;
                }

                success(message);

                this.resetForm();
                this.$refs.form.elements[0].focus();
            },
        })
            .catch(({ responseJSON }) => {
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
