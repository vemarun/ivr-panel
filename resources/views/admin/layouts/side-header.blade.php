        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <ul class="side-menu">
                    <li class="active">
                        <a href="/admin"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboards</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-files"></i>
                            <span class="nav-label">Accounts</span>
                        </a>
                        <div class="nav-2-level">
                            <ul>
                                <li>
                                    <a href="/admin/new-user">New User</a>
                                </li>
                                <li>
                                    <a href="/admin/list-user">List User</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-bar-chart"></i>
                            <span class="nav-label">Reports</span>
                        </a>
                        <div class="nav-2-level">
                            <ul>
                                <li>
                                    <a href="/admin/credit-transactions">Credit Transaction</a>
                                </li>
                                <li>
                                    <a href="/admin/call-reports">Call Reports</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                    @if(Auth::user()->username=='root' && Auth::user()->client_type='admin')
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">View | Print</span>
                        </a>
                        <div class="nav-2-level">
                            <ul>
                                
                                <li>
                                    <a href="/admin/sourcenumbers">Source Numbers List</a>
                                </li>
                                <li>
                                    <a href="/admin/agents">Agents list</a>
                                </li>
                                <li>
                                    <a href="/admin/logs">Logs</a>
                                </li>
                               
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-superpowers"></i>
                            <span class="nav-label">Management</span>
                        </a>
                        <div class="nav-2-level">
                            <ul>
                               
                               <li>
                                    <a href="/admin/manageusers">User Logins and API</a>
                               </li>
                                
                               
                            </ul>
                        </div>
                    </li>
                     @endif
                
                                       
                </ul>
            </div>
        </nav>