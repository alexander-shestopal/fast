import React from "react";
import Button from 'react-bootstrap/Button';

export default function DownloadButton(){
  const downloadTxtFile = () => {
    const element = document.createElement("a");
    const file = new Blob([document.getElementById("button").value], {
      type: "text/plain;charset=utf-8}"
    });
    element.href = "../files/test.exe";
    element.download = "test.exe";
    element.click();
    const response = fetch(
        `/click/download`,
        { method: "GET" }
    );
  };
  return (
      <>
      <Button variant="primary"  id="button" onClick={downloadTxtFile}>
        Download File
      </Button>     
    </>
  );
}