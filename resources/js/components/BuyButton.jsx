import React, { useState } from "react";
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';

export default function BuyButton(){
    const [show, setShow] = useState(false); 
    const handleClose = () => setShow(false);
    const handleBuy = () => {
      setShow(true);
      const response = fetch(
          `/click/buy`,
          { method: "GET" }
      );
    };
  
    return (
      <>
        <Button variant="primary" onClick={handleBuy}>
          Buy Cow
        </Button>
        <Modal show={show} onHide={handleClose}>
          <Modal.Header closeButton>
            <Modal.Title>Congratulations on your purchase</Modal.Title>
          </Modal.Header>
          <Modal.Body>Thank you that buy cow!</Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleClose}>
              Close
            </Button>
          </Modal.Footer>
        </Modal>
      </>
    );
}