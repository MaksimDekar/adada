'use client';

import Link from 'next/link';
import { useState } from 'react';

export default function ContactPage() {
  const [submitted, setSubmitted] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setSubmitted(true);
    setTimeout(() => setSubmitted(false), 3000);
  };

  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
            <span className="brand__text"><strong>EU KASKO</strong></span>
          </Link>
          <div className="header__actions">
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>

      <main id="content">
        <section className="section">
          <div className="container">
            <div className="page-head">
              <h1>Контакты</h1>
            </div>

            <div className="grid2">
              <div className="card">
                <h2>Свяжитесь с нами</h2>
                <form onSubmit={handleSubmit} className="form">
                  <div className="field">
                    <label htmlFor="name">Имя</label>
                    <input id="name" type="text" placeholder="Ваше имя" required />
                  </div>
                  <div className="field">
                    <label htmlFor="email">Email</label>
                    <input id="email" type="email" placeholder="example@mail.com" required />
                  </div>
                  <div className="field">
                    <label htmlFor="message">Сообщение</label>
                    <textarea id="message" placeholder="Ваше сообщение..." rows={5} required></textarea>
                  </div>
                  <button type="submit" className="btn btn--primary btn--full">Отправить</button>
                  {submitted && <p className="success">Спасибо! Ваше сообщение отправлено.</p>}
                </form>
              </div>

              <div className="card">
                <h2>Информация</h2>
                <p><strong>Email:</strong> support@eukasko.ru</p>
                <p><strong>Телефон:</strong> +7 (495) 123-45-67</p>
                <p><strong>Часы работы:</strong> 24/7</p>
              </div>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
