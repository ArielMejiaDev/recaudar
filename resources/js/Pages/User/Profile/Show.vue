<template>
<div>

    <EditUser />

    <ChangePassword />

    <EditAvatar />

    <ProfileDetail />

</div>
</template>

<script>
import SidebarLayout from "../../../Shared/Layouts/SidebarLayout";
import EditUser from "./UpdateCredentials";
import ChangePassword from "./UpdatePassword";
import EditAvatar from "./UpdateAvatar";
import ProfileDetail from "./Detail";

export default {
    metaInfo: { title: 'Profile' },
    name: "Profile",
    layout: SidebarLayout,
    components: { EditUser, ChangePassword, EditAvatar, ProfileDetail, },
}
</script>
