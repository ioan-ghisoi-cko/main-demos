import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';


class App extends Component {

  constructor(props) {
    super(props);
    this.state = {
      token: ""
    };
  }

  componentDidMount() {
    var context = this;
    var paymentForm = document.getElementById('payment-form');
    var payNowButton = document.getElementById("pay-now-button");

    window.Frames.init({
      publicKey: 'pk_test_4296fd52-efba-4a38-b6ce-cf0d93639d8a',
      containerSelector: '.frames-container',
      cardValidationChanged: function () {
        payNowButton.disabled = !window.Frames.isCardValid();
      },
      cardSubmitted: function () {
        payNowButton.disabled = true;
      }
    });
    paymentForm.addEventListener('submit', function (event) {
      event.preventDefault();
      window.Frames.submitCard()
        .then(function (data) {
          console.log(data.cardToken)
          context.setState({
            token: data.cardToken
          });

          // You can now pass the token to your server to perform a charge request

        })
        .catch(function (err) {
        });
    });
  }

  render() {
    return (
      <div className="App">
        <form id="payment-form" method="POST">
          <div className="frames-container">
          </div>
          <button id="pay-now-button" type="submit" disabled>Pay now</button>
        </form>
      </div>
    );
  }
}

export default App;
