'use client';

import Link from 'next/link';
import { useState } from 'react';

const CARS = {
  'Audi': ['A3','A4','A6','Q3','Q5','Q7'],
  'BMW': ['1 Series','3 Series','5 Series','X1','X3','X5'],
  'Mercedes-Benz': ['A-Class','C-Class','E-Class','GLA','GLC','GLE'],
  'Volkswagen': ['Golf','Passat','Tiguan','Touareg','Polo'],
};

const YEARS = Array.from({ length: 10 }, (_, i) => 2025 - i);

export default function QuotePage() {
  const [brand, setBrand] = useState('');
  const [year, setYear] = useState('');
  const [model, setModel] = useState('');
  const [carValue, setCarValue] = useState('500000');
  const [experience, setExperience] = useState('3');
  const [deductible, setDeductible] = useState('15000');
  const [quote, setQuote] = useState<any>(null);

  const calculateQuote = (e: React.FormEvent) => {
    e.preventDefault();
    
    const premiumClasses: Record<string, number> = {
      'Audi': 0.065, 'BMW': 0.065, 'Mercedes-Benz': 0.065,
      'Volkswagen': 0.055, 'Skoda': 0.055,
    };
    
    const rate = premiumClasses[brand] || 0.055;
    const value = parseFloat(carValue) || 500000;
    const exp = parseFloat(experience) || 3;
    const ageFactor = 1 + (2025 - parseInt(year)) * 0.02;
    const expFactor = Math.max(0.85, Math.min(1.25, 1.25 - exp * 0.03));
    const dedFactors: Record<number, number> = { 0: 1.15, 15000: 1.0, 30000: 0.92, 60000: 0.82 };
    const dedFactor = dedFactors[parseInt(deductible)] || 1.0;
    
    const priceYear = Math.round(value * rate * ageFactor * expFactor * dedFactor);
    const priceMonth = Math.round(priceYear / 12);
    
    setQuote({
      priceYear,
      priceMonth,
      brand,
      model,
      year,
    });
  };

  return (
    <>
      <header className="header">
        <div className="container header__inner">
          <Link href="/" className="brand">
            <span className="brand__logo">EU</span>
            <span className="brand__text">
              <strong>EU KASKO</strong>
              <small>• EU авто 2016–2025</small>
            </span>
          </Link>
          <div className="header__actions">
            <Link className="btn btn--primary" href="/quote">Рассчитать</Link>
          </div>
        </div>
      </header>

      <main id="content">
        <section className="section">
          <div className="container">
            <div className="page-head reveal">
              <h1>Калькулятор КАСКО</h1>
              <p className="muted">Только европейские бренды и годы <strong>2016–2025</strong>. Валюта: ₽.</p>
            </div>

            <div className="grid2">
              <section className="card reveal">
                <h2 className="h3">Данные авто</h2>
                <form className="form" onSubmit={calculateQuote} noValidate>
                  <div className="field">
                    <label htmlFor="year">Год выпуска</label>
                    <select
                      id="year"
                      value={year}
                      onChange={(e) => setYear(e.target.value)}
                      required
                    >
                      <option value="">Выберите год</option>
                      {YEARS.map(y => <option key={y} value={y}>{y}</option>)}
                    </select>
                  </div>

                  <div className="field">
                    <label htmlFor="brand">Марка (EU)</label>
                    <select
                      id="brand"
                      value={brand}
                      onChange={(e) => setBrand(e.target.value)}
                      required
                    >
                      <option value="">Выберите марку</option>
                      {Object.keys(CARS).map(b => <option key={b} value={b}>{b}</option>)}
                    </select>
                  </div>

                  <div className="field">
                    <label htmlFor="model">Модель</label>
                    <select
                      id="model"
                      value={model}
                      onChange={(e) => setModel(e.target.value)}
                      disabled={!brand}
                      required
                    >
                      <option value="">Выберите модель</option>
                      {brand && CARS[brand as keyof typeof CARS]?.map(m => (
                        <option key={m} value={m}>{m}</option>
                      ))}
                    </select>
                  </div>

                  <hr className="sep" />
                  <h3 className="h4">Параметры расчета</h3>

                  <div className="field">
                    <label htmlFor="carValue">Стоимость авто (₽)</label>
                    <input
                      id="carValue"
                      type="number"
                      value={carValue}
                      onChange={(e) => setCarValue(e.target.value)}
                      min="100000"
                      max="10000000"
                      required
                    />
                  </div>

                  <div className="field">
                    <label htmlFor="experience">Стаж вождения (лет)</label>
                    <input
                      id="experience"
                      type="number"
                      value={experience}
                      onChange={(e) => setExperience(e.target.value)}
                      min="0"
                      max="50"
                      required
                    />
                  </div>

                  <div className="field">
                    <label htmlFor="deductible">Франшиза (₽)</label>
                    <select
                      id="deductible"
                      value={deductible}
                      onChange={(e) => setDeductible(e.target.value)}
                      required
                    >
                      <option value="0">Без франшизы</option>
                      <option value="15000">15 000 ₽</option>
                      <option value="30000">30 000 ₽</option>
                      <option value="60000">60 000 ₽</option>
                    </select>
                  </div>

                  <button type="submit" className="btn btn--primary btn--full">
                    Рассчитать
                  </button>
                </form>
              </section>

              {quote && (
                <section className="card reveal">
                  <h2 className="h3">Ваш расчет</h2>
                  <div className="quote-result">
                    <p className="muted">
                      {quote.year} {quote.brand} {quote.model}
                    </p>
                    <div className="quote-prices">
                      <div className="price-item">
                        <span>В год</span>
                        <strong className="h2">{quote.priceYear.toLocaleString('ru-RU')} ₽</strong>
                      </div>
                      <div className="price-item">
                        <span>В месяц</span>
                        <strong className="h3">{quote.priceMonth.toLocaleString('ru-RU')} ₽</strong>
                      </div>
                    </div>
                    <Link href="/checkout" className="btn btn--primary btn--full">
                      Оформить полис
                    </Link>
                  </div>
                </section>
              )}
            </div>
          </div>
        </section>
      </main>
    </>
  );
}
