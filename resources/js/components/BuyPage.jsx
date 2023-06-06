import React from "react";
import ReactDOM from "react-dom/client";
import BuyButton from './BuyButton';

export default function BuyPage(){

  return (
    <div className="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                <div class="card-header">BuyPage</div>
                <div class="card-body"><BuyButton></BuyButton></div>
              </div>
          </div>
      </div>
    </div>
  );
}

const root = document.getElementById("buy");
if (root){
    ReactDOM.createRoot(root).render(<BuyPage/>);
};
