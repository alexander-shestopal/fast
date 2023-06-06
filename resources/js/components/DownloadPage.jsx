import React from "react";
import ReactDOM from "react-dom/client";
import DownloadButton from './DownloadButton';

export default function DownloadPage(){

  return (
    <div className="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">DownloadPage</div>
                <div class="card-body"><DownloadButton></DownloadButton></div>
              </div>
          </div>
      </div>
    </div>
  );
}

const root = document.getElementById("download");
if (root){
    ReactDOM.createRoot(root).render(<DownloadPage/>);
};
