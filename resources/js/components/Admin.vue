<template>
    <div id="app">
        <v-app id="inspire" dark>
            <v-navigation-drawer
                    clipped
                    fixed
                    v-model="drawer"
                    app
            >
                <v-list dense>

                    <v-list-tile exact to="/admin">
                        <v-list-tile-action>
                            <v-icon>dashboard</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Dashboard</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>


                    <v-list-group
                            v-if="$auth.can('view-usermanagement')"
                            no-action
                    >
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


                    <v-list-tile to="/admin/settings">
                        <v-list-tile-action>
                            <v-icon>settings</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Settings</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>

            </v-navigation-drawer>

            <v-toolbar app fixed clipped-left>
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-toolbar-title>Laravel Vue Admin</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-menu offset-y origin="center center" class="elelvation-1" :nudge-bottom="14" transition="scale-transition">
                    <v-btn icon flat slot="activator">
                        <v-badge color="red" overlap>
                            <span slot="badge">3</span>
                            <v-icon medium>notifications</v-icon>
                        </v-badge>
                    </v-btn>
                    <ul>
                        <li>notification 1</li>
                        <li>notification 2</li>
                    </ul>
                    <!--<notification-list></notification-list>-->
                </v-menu>
                <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
                    <v-btn icon large flat slot="activator">
                        <v-avatar size="30px">
                            <img src="https://via.placeholder.com/150" alt="Michael Wang"/>

                        </v-avatar>
                    </v-btn>
                    <v-list class="pa-0">
                        <v-list-tile
                                ripple="ripple"
                                rel="noopener"
                        >
                            <v-list-tile-content>
                                <v-list-tile-title>{{user.name}}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>

                    <v-list class="pa-0">
                        <v-list-tile
                                @click="logout"
                                ripple="ripple"
                                rel="noopener"
                        >
                            <v-list-tile-action >
                                <v-icon>account_circle</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>Logout</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-toolbar>


            <v-content>
                <v-container fluid fill-height>
                    <v-layout justify-center>
                        <v-flex shrink>
                            <router-view></router-view>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer app fixed>
                <span>&copy; 2019</span>
            </v-footer>
        </v-app>
    </div>
</template>

<script>
  export default {
    data: () => ({
      drawer: null,
    }),
    props:['user'],
    
    methods:{
      logout() {
        console.log('logging out');
      }
    }
  };
</script>