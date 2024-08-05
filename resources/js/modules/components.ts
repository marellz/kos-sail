import FormError from "../components/form/error.vue";
import FormLabel from "@/components/form/label.vue";
import FormInput from "@/components/form/input.vue";
import FormRadio from "@/components/form/radio.vue";
import FormCheckbox from "@/components/form/checkbox.vue";
import FormGroup from "@/components/form/group.vue";

import BaseButton from "@/components/base/button.vue";
import BaseDropdown from "@/components/base/dropdown.vue";
import BaseDropdownLink from "@/components/base/dropdown-link.vue";
import BaseLogo from "@/components/base/logo.vue";
import BaseModal from "@/components/base/modal.vue";

export const components = {
    "form-error": FormError,
    "form-label": FormLabel,
    "form-input": FormInput,
    "form-radio": FormRadio,
    "form-checkbox": FormCheckbox,
    "form-group": FormGroup,

    "base-button": BaseButton,
    dropdown: BaseDropdown,
    "dropdown-link": BaseDropdownLink,
    "base-modal": BaseModal,
    "base-logo": BaseLogo,
};

