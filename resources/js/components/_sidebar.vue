<template>
  <v-list dense>
    <v-list-tile exact to="/admin">
      <v-list-tile-action>
        <v-icon>dashboard</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Dashboard</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-group no-action>
      <v-list-tile slot="activator">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>User Management</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile to="/admin/users">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>Users</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile to="/admin/roles">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>Roles</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile to="/admin/permissions">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>Permissions</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list-group>

    <v-list-tile to="/admin/activities">
      <v-list-tile-action>
        <v-icon>settings</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Activities</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-tile to="/admin/settings">
      <v-list-tile-action>
        <v-icon>settings</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Settings</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
  </v-list>
</template>


<script>
export default {
    
}

</script>


