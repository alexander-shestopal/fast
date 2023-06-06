import React from "react";
import ReactDOM from "react-dom/client";

export default function DashboardPage({date, name, email, role}){
  return (
    <div className="container">
      <div class="row justify-content-center">
          <div class="col-md-8">

              <div class="card">
                  <div class="card-header">Dashboard</div>

                  <div class="card-body">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Date</th>
                                  <th>User</th>
                                  <th>Email</th>
                                  <th>Role</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>{date}</td>
                                  <td>{name}</td>
                                  <td>{email}</td>
                                  <td>{role}</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
  );
}

const root = document.getElementById('dashboard');
if (root){
    const props = Object.assign({}, root.dataset);
    ReactDOM.createRoot(root).render(<DashboardPage {...props}/>);
};
