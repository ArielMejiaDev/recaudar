<template>
<div>

    <EditUser :trans="trans" />

    <ChangePassword :trans="trans" />

    <EditAvatar :trans="trans" :avatar="avatar" />

</div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import EditUser from "./UpdateCredentials";
import ChangePassword from "./UpdatePassword";
import EditAvatar from "./UpdateAvatar";

export default {
    metaInfo: { title: 'Profile' },
    name: "Profile",
    layout: SidebarLayout,
    components: { EditUser, ChangePassword, EditAvatar, },
    props: {
        trans: Object,
        avatar: String,
    }
}
</script>
