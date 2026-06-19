import type { Metadata } from 'next'
import './globals.css'

export const metadata: Metadata = {
  title: 'EU KASKO - Страховка для европейских авто',
  description: 'КАСКО для европейских автомобилей 2016-2025 года выпуска',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="ru">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="/css/styles.css" />
      </head>
      <body>{children}</body>
    </html>
  )
}
