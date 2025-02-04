<div id="residentsContainer" class="container">
    <div class="headerss">
        LIST OF ALL RESIDENTS
    </div>
    <form class='main-table-container' action="" enctype="multipart/form-data">
        @csrf
        <div class="table-container">
            <div class="sub-main">
                
                <div class="search-area">
                    <input type="search" id="searchess" name="search" placeholder="Search" onkeyup="filterTable()">
                    <span class="search-icon"><i class='bx bx-search'></i></span>
                </div>

                <div class="sort-container">    
                    <select id="SortRrejectedResidents" onchange="sortRejectedInfo()">
                        <option value="" disabled selected>View Residents</option>
                        <option value="REJECTED">Rejected Residents</option>
                        <option value="VERIFIED">Verified Residents</option>
                        <option value="REMOVED">Removed Residents</option>
                    </select>
                </div>

            </div>
            <div id="validResidents" class="containers">
                <table id="verifiedTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FULLNAME</th>
                            <th>AGE</th>
                            <th>EMAIL</th>
                            <th>RESIDENT TYPE</th>
                            <th>DATE REGISTERED</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usersVerified as $usersVerifieds)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usersVerifieds->name }} {{ $usersVerifieds->mname ?? '' }}
                                    {{ $usersVerifieds->lname }}
                                    {{ $usersVerifieds->suffix ?? '' }}
                                </td>
                                <td>{{ $usersVerifieds->age  }}</td>
                                <td>{{ $usersVerifieds->email}}</td>
                                <td>{{ $usersVerifieds->residenttype }}</td>
                                <td>{{ $usersVerifieds->created_at}}</td>
                                <td style="padding:10px;">
                                    <a href="#" onclick='removeResidents({{ $usersVerifieds->id}})' class="view-btns">
                                        REMOVE
                                    </a>
                                </td>
                            </tr>
                            <tr id="noDataRow" style="display: none;">
                                <td colspan="7" style="text-align: center;">No data found</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center;">No residents found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                    <span id="countValue">{{ $usersVerified->count() }} of {{ $usersVerified->count() }}</span>
                </div>
            </div>

            <div id="rejectContainer" style="display:none" class="containers">
                <table id="announcementTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FULLNAME</th>
                            <th>EMAIL</th>
                            <th>DATE REGISTERED</th>
                            <th>DATE REJECTED</th>
                            <th>REASON FOR REJECTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usersRejected as $usersRejecteds)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usersRejecteds->name }}
                                    {{ $usersRejecteds->mname ?? '' }}
                                    {{ $usersRejecteds->lname }}
                                    {{ $usersRejecteds->suffix ?? '' }}
                                </td>
                                <td>{{ $usersRejecteds->email}}</td>
                                <td>{{ $usersRejecteds->created_at}}</td>
                                <td>{{ $usersRejecteds->updated_at}}</td>
                                <td>{{ $usersRejecteds->response}}</td>
                            </tr>
                            <tr id="noDataRow" style="display: none;">
                                <td colspan="7" style="text-align: center;">No data found</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center;">No residents found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                    <span id="countValues">{{ $usersRejected->count() }} of {{ $usersRejected->count() }}</span>
                </div>
            </div>

            <div id="removedContainer" style="display:none" class="containers">
                <table id="announcementTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FULLNAME</th>
                            <th>EMAIL</th>
                            <th>DATE REGISTERED</th>
                            <th>DATE REMOVED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usersRemove as $usersRemoved)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usersRemoved->name }}
                                    {{ $usersRemoved->mname ?? '' }}
                                    {{ $usersRemoved->lname }}
                                    {{ $usersRemoved->suffix ?? '' }}
                                </td>
                                <td>{{ $usersRemoved->email}}</td>
                                <td>{{ $usersRemoved->created_at}}</td>
                                <td>{{ $usersRemoved->updated_at}}</td>

                            </tr>
                            <tr id="noDataRow" style="display: none;">
                                <td colspan="7" style="text-align: center;">No data found</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">No residents found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="dataCount" style="text-align: right; margin-top: 10px; font-size: 14px;">
                    <span id="countValuess">{{ $usersRemove->count() }} of {{ $usersRemove->count() }}</span>
                </div>
            </div>
        </div>
    </form>
</div>