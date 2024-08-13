import FormError from "../components/form/error.vue";
import FormLabel from "@/components/form/label.vue";
import FormInput from "@/components/form/input.vue";
import FormRadio from "@/components/form/radio.vue";
import FormCheckbox from "@/components/form/checkbox.vue";
import FormGroup from "@/components/form/group.vue";
import FormText from "@/components/form/text.vue";
import FormSelect from "@/components/form/select.vue";

import FilterSearch from "@/components/filter/search.vue";
import FilterToggle from "@/components/filter/toggle.vue";
import FilterForm from "@/components/filter/form.vue";

import BaseButton from "@/components/base/button.vue";
import BaseDropdown from "@/components/base/dropdown.vue";
import BaseDropdownLink from "@/components/base/dropdown-link.vue";
import BaseLogo from "@/components/base/logo.vue";
import BaseModal from "@/components/base/modal.vue";

import PageHead from "@/components/page/head.vue";
import PageTitle from "@/components/page/title.vue";
import PageDescription from "@/components/page/description.vue";
import LayoutContainer from "@/components/page/container.vue";
import NavResponsiveLink from "@/components/nav/responsive-link.vue";
import NavLink from "@/components/nav/link.vue";
import Pagination from "@/components/nav/pagination.vue";

export const components = {
    "form-error": FormError,
    "form-label": FormLabel,
    "form-input": FormInput,
    "form-radio": FormRadio,
    "form-checkbox": FormCheckbox,
    "form-group": FormGroup,
    "form-text": FormText,
    "form-select": FormSelect,

    "filter-search": FilterSearch,
    "filter-toggle": FilterToggle,
    "filter-form": FilterForm,

    "base-button": BaseButton,
    "dropdown": BaseDropdown,
    "dropdown-link": BaseDropdownLink,
    "base-modal": BaseModal,
    "base-logo": BaseLogo,
    
    "nav-link": NavLink,
    "nav-responsive-link": NavResponsiveLink,
    "pagination": Pagination,

    "page-head": PageHead,
    "page-title": PageTitle,
    "page-description": PageDescription,
    "layout-container": LayoutContainer,
};
