'use client';

import Link from 'next/link';
import { useState } from 'react';

export default function RegisterPage() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    alert('Система регистрации в разработке');
  };

  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
          </Link>
        </div>
      </header>

      <main id="content">
        <section className="section">
          <div className="container">
            <div className="grid2-center">
              <div className="card">
                <h1>Регистрация</h1>
                <form onSubmit={handleSubmit} className="form">
                  <div className="field">
                    <label htmlFor="email">Email</label>
                    <input
                      id="email"
                      type="email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      placeholder="example@mail.com"
                      required
                    />
                  </div>
                  <div className="field">
                    <label htmlFor="password">Пароль</label>
                    <input
                      id="password"
                      type="password"
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      placeholder="Минимум 6 символов"
                      required
                    />
                  </div>
                  <button type="submit" className="btn btn--primary btn--full">Зарегистрироваться</button>
                </form>
                <p className="muted">
                  Уже есть аккаунт? <Link href="/login">Войдите</Link>
                </p>
              </div>
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
